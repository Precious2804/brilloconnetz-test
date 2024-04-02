<?php

namespace App\Controllers;

use App\Models\ResetCodeModel;
use App\Models\UserModel;
use App\Models\VerificationCodeModel;
use CodeIgniter\HTTP\Request;

class AuthController extends BaseController
{
    public function register()
    {
        return view('register');
    }

    public function submitRegister()
    {
        helper(['form']);
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|string',
            'email' => 'required|valid_email|is_unique[users.email]',
            'phone' => 'required',
            'interest' => 'required|string',
            'password' => 'required|min_length[6]',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();

        $emailAddress = $this->request->getPost('email');
        $name = $this->request->getPost('name');
        $verificationCode = rand(00000, 99999);

        $userData = [
            'name' => $name,
            'email' => $emailAddress,
            'phone' => $this->request->getPost('phone'),
            'interest' => $this->request->getPost('interest'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $userModel->save($userData);

        $codeModel = new VerificationCodeModel();
        $codeModel->save([
            'email' => $emailAddress,
            'code' => $verificationCode
        ]);

        // Send verification email
        $message = 'Hi ' . $name . ', <br><br>Please verify your account by clicking on the link below: <br>' . base_url() . '/verify?email=' . $emailAddress . '&code=' . $verificationCode;
        $sendMail = $this->sendMailNotification($emailAddress, 'Account Verification', $message);
        if ($sendMail == true) {
            return redirect()->back()->with('success', $emailAddress);
        }
    }

    public function verify()
    {
        $email = $this->request->getVar('email');
        $code = $this->request->getVar('code');

        // Verify code as valid
        $codeModel = new VerificationCodeModel();
        $checkCode = $codeModel->where('code', $code)->first();
        if (!$checkCode) {
            return redirect('login')->with('error', "Invalid Verification Code");
        }

        // Update user's verification status
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();
        if ($user) {
            $data = [
                'is_verified' => 1
            ];
            $userModel->update($user['id'], $data);

            // Delete the verification code
            $codeModel->delete($checkCode['id']);
        }

        return redirect('login')->with('success', "Verification was successful");
    }


    public function login()
    {
        return view('login');
    }

    public function submitLogin()
    {
        helper(['form']);
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Login successful, store user data in session
            session()->set(['user' => $user]);
            return redirect()->to('dashboard');
        } else {
            return redirect()->back()->withInput()->with('error', 'Invalid Login Credentials');
        }
    }

    public function forgot()
    {
        return view('forgot');
    }

    public function requestPassReset()
    {
        helper(['form']);
        $validation = \Config\Services::validation();
        $validation->setRules([
            'email' => 'required|valid_email',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $emailAddress = $this->request->getPost('email');
        $resetCode = rand(00000, 99999);

        $codeModel = new ResetCodeModel();
        $codeModel->save([
            'email' => $emailAddress,
            'code' => $resetCode
        ]);

        $userModel = new UserModel();
        $user = $userModel->where('email', $emailAddress)->first();
        if ($user) {
            $message = 'Hi ' . $user['name'] . ',<br><br>You are receiving this email because of a password reset request by your email address.<br>Please visit the link below to complete the password reset process <br>' . base_url() . '/reset-password?email=' . $emailAddress . '&code=' . $resetCode;
            $sendMail = $this->sendMailNotification($emailAddress, 'Password Reset', $message);
            if ($sendMail == true) {
                return redirect()->back()->with('success', $emailAddress);
            }
        } else {
            return redirect()->back()->with('fail', "Invalid Email Address");
        }
    }

    public function resetPassword()
    {
        $email = $this->request->getVar('email');
        $code = $this->request->getVar('code');
        return view('reset-password', ['email' => $email, 'code' => $code]);
    }

    public function submitResetPassword()
    {
        helper(['form']);
        $validation = \Config\Services::validation();
        $validation->setRules([
            'code' => 'required',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]'
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $code = $this->request->getPost('code');
        $email = $this->request->getPost('email');

        // Verify reset code as valid
        $codeModel = new ResetCodeModel();
        $checkCode = $codeModel->where('code', $code)->first();
        if (!$checkCode) {
            return redirect('login')->with('error', "Invalid Reset Code");
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();
        if ($user) {
            $data = [
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            $userModel->update($user['id'], $data);

            // Delete the verification code
            $codeModel->delete($checkCode['id']);
        }
        return redirect('login')->with('success', "Password has been updated Successfully");
    }







    private function sendMailNotification($emailAddress, $subject, $message)
    {
        $email = \Config\Services::email();

        // Set email parameters
        $email->setTo($emailAddress);
        $email->setFrom('email@example.com', 'FullStack Dev Test');
        $email->setSubject($subject);
        $email->setMessage($message);

        // Send email
        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }
}
