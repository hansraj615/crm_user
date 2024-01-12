<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function signup()
{
    // Redirect to dashboard if the user is already authenticated
    if ($this->request->getSession()->read('Auth')) {
        return $this->redirect(['action' => 'index']);
    }

    $user = $this->Users->newEntity($this->request->getData());

    if ($this->request->is('post')) {
        $user = $this->Users->patchEntity($user, $this->request->getData());
        $user->password = (new DefaultPasswordHasher)->hash($this->request->getData('password'));

        if ($this->Users->save($user)) {
            $this->Flash->success('Account created successfully.');

            // Log in the user
            $this->Auth->setUser($user);

            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error('Unable to create your account. Please, try again.');
        }
    }

    $this->set(compact('user'));
    $this->set('states', $this->getIndianStates());
}


    private function getIndianStates()
    {
        return ['Karnataka', 'Bihar', 'Punjab','West Bengal'];
    }



    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('stateNames', $this->getIndianStates());
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }



    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $this->set(compact('user'));
        $this->set('states', $this->getIndianStates());
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    // public function signin()
    // {
    //     if ($this->request->is('post')) {
    //         // Check if the request is a POST request (form submission)

    //         $user = $this->Auth->identify();

    //         if ($user) {
    //             // If a user is identified, log them in
    //             $this->Auth->setUser($user);
    //             $this->Flash->success('Welcome back!');
    //             return $this->redirect(['action' => 'index']);
    //         } else {
    //             // If no user is identified, show an error message
    //             $this->Flash->error('Invalid email or password, try again.');
    //         }
    //     }
    // }

    public function login()
    {
        if ($this->request->getSession()->read('Auth')) {
            return $this->redirect(['action' => 'index']);
        }
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success('Welcome back!');
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error('Invalid email or password, try again.');
            }
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function isAuthorized($user)
    {
        return true;
    }


}
