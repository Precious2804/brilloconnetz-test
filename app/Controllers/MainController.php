<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class MainController extends BaseController
{
    public function dashboard()
    {
        if (!session()->has('user')) {
            return redirect('login')->with('error', 'You must be logged in to access this page.');
        }
        return view('dashboard');
    }

    public function settings()
    {
        if (!session()->has('user')) {
            return redirect('login')->with('error', 'You must be logged in to access this page.');
        }
        return view('settings');
    }

    public function updateProfile()
    {
        helper(['form']);
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|string',
            'email' => 'required|valid_email|is_unique[users.email,id,' . session('user')['id'] . ']',
            'phone' => 'required',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->find(session('user')['id']);

        if ($user) {
            $data = [
                'name' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'interest' => $this->request->getPost('interest'),
            ];
            $userModel->update($user['id'], $data);
            // Reset session with new user info
            session()->set(['user' => [
                'id' => session('user')['id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'interest' => $data['interest'],
            ]]);

            return redirect()->back()->with('success', "Update was successful");
        }
    }

    public function updatePassword()
    {
        helper(['form']);
        $validation = \Config\Services::validation();
        $validation->setRules([
            'old_password' => 'required',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]'
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->find(session('user')['id']);

        if ($user) {
            // Verify old password
            if (!password_verify($this->request->getPost('old_password'), $user['password'])) {
                return redirect()->back()->withInput()->with('errors', ['old_password' => 'The old password is incorrect.']);
            }

            $data = [
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];
            $userModel->update($user['id'], $data);

            return redirect()->back()->with('success', "Update was successful");
        }
    }

    public function buddies()
    {
        if (!session()->has('user')) {
            return redirect('login')->with('error', 'You must be logged in to access this page.');
        }
        $userModel = new UserModel();
        $currentUser = session('user');

        // Retrieve buddies excluding the current user
        $buddies = $userModel->where('interest', $currentUser['interest'])
            ->where('id !=', $currentUser['id']) // Exclude the current user
            ->findAll();
            
        return view('buddies', ['buddies' => $buddies]);
    }

    public function logout()
    {
        $session = session();
        // Check if user is logged in before attempting to destroy the session
        if ($session->has('user')) {
            $session->destroy();
        }
        return redirect('login')->with('success', "Logout was successful");
    }
}
