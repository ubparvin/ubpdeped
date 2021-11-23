<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Receives Controller
 *
 * @property \App\Model\Table\ReceivesTable $Receives
 * @method \App\Model\Entity\Receife[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReceivesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Receiveables', 'Schools', 'Offices', 'Users'],
        ];
        $receives = $this->paginate($this->Receives);

        $this->set(compact('receives'));
    }

    /**
     * View method
     *
     * @param string|null $id Receife id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $receife = $this->Receives->get($id, [
            'contain' => ['Receiveables', 'Schools', 'Offices', 'Users'],
        ]);

        $this->set(compact('receife'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $receife = $this->Receives->newEmptyEntity();
        if ($this->request->is('post')) {
            $receife = $this->Receives->patchEntity($receife, $this->request->getData());
            if ($this->Receives->save($receife)) {
                $this->Flash->success(__('The receife has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The receife could not be saved. Please, try again.'));
        }
        $receiveables = $this->Receives->Receiveables->find('list', ['limit' => 200]);
        $schools = $this->Receives->Schools->find('list', ['limit' => 200]);
        $offices = $this->Receives->Offices->find('list', ['limit' => 200]);
        $users = $this->Receives->Users->find('list', ['limit' => 200]);
        $this->set(compact('receife', 'receiveables', 'schools', 'offices', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Receife id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $receife = $this->Receives->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $receife = $this->Receives->patchEntity($receife, $this->request->getData());
            if ($this->Receives->save($receife)) {
                $this->Flash->success(__('The receife has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The receife could not be saved. Please, try again.'));
        }
        $receiveables = $this->Receives->Receiveables->find('list', ['limit' => 200]);
        $schools = $this->Receives->Schools->find('list', ['limit' => 200]);
        $offices = $this->Receives->Offices->find('list', ['limit' => 200]);
        $users = $this->Receives->Users->find('list', ['limit' => 200]);
        $this->set(compact('receife', 'receiveables', 'schools', 'offices', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Receife id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $receife = $this->Receives->get($id);
        if ($this->Receives->delete($receife)) {
            $this->Flash->success(__('The receife has been deleted.'));
        } else {
            $this->Flash->error(__('The receife could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
