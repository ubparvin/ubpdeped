<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Receivables Controller
 *
 * @property \App\Model\Table\ReceivablesTable $Receivables
 * @method \App\Model\Entity\Receivable[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReceivablesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Orders', 'Schools', 'Offices'],
        ];
        $receivables = $this->paginate($this->Receivables);

        $this->set(compact('receivables'));
    }

    /**
     * View method
     *
     * @param string|null $id Receivable id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $receivable = $this->Receivables->get($id, [
            'contain' => ['Users', 'Orders', 'Schools', 'Offices'],
        ]);

        $this->set(compact('receivable'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $receivable = $this->Receivables->newEmptyEntity();
        if ($this->request->is('post')) {
            $receivable = $this->Receivables->patchEntity($receivable, $this->request->getData());
            if ($this->Receivables->save($receivable)) {
                $this->Flash->success(__('The receivable has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The receivable could not be saved. Please, try again.'));
        }
        $users = $this->Receivables->Users->find('list', ['limit' => 200]);
        $orders = $this->Receivables->Orders->find('list', ['limit' => 200]);
        $schools = $this->Receivables->Schools->find('list', ['limit' => 200]);
        $offices = $this->Receivables->Offices->find('list', ['limit' => 200]);
        $this->set(compact('receivable', 'users', 'orders', 'schools', 'offices'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Receivable id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $receivable = $this->Receivables->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $receivable = $this->Receivables->patchEntity($receivable, $this->request->getData());
            if ($this->Receivables->save($receivable)) {
                $this->Flash->success(__('The receivable has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The receivable could not be saved. Please, try again.'));
        }
        $users = $this->Receivables->Users->find('list', ['limit' => 200]);
        $orders = $this->Receivables->Orders->find('list', ['limit' => 200]);
        $schools = $this->Receivables->Schools->find('list', ['limit' => 200]);
        $offices = $this->Receivables->Offices->find('list', ['limit' => 200]);
        $this->set(compact('receivable', 'users', 'orders', 'schools', 'offices'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Receivable id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $receivable = $this->Receivables->get($id);
        if ($this->Receivables->delete($receivable)) {
            $this->Flash->success(__('The receivable has been deleted.'));
        } else {
            $this->Flash->error(__('The receivable could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
