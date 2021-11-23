<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Schoolinventories Controller
 *
 * @property \App\Model\Table\SchoolinventoriesTable $Schoolinventories
 * @method \App\Model\Entity\Schoolinventory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SchoolinventoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Schools', 'Logistics'],
        ];
        $schoolinventories = $this->paginate($this->Schoolinventories);

        $this->set(compact('schoolinventories'));
    }

    /**
     * View method
     *
     * @param string|null $id Schoolinventory id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schoolinventory = $this->Schoolinventories->get($id, [
            'contain' => ['Schools', 'Logistics'],
        ]);

        $this->set(compact('schoolinventory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $schoolinventory = $this->Schoolinventories->newEmptyEntity();
        if ($this->request->is('post')) {
            $schoolinventory = $this->Schoolinventories->patchEntity($schoolinventory, $this->request->getData());
            if ($this->Schoolinventories->save($schoolinventory)) {
                $this->Flash->success(__('The schoolinventory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The schoolinventory could not be saved. Please, try again.'));
        }
        $schools = $this->Schoolinventories->Schools->find('list', ['limit' => 200]);
        $logistics = $this->Schoolinventories->Logistics->find('list', ['limit' => 200]);
        $this->set(compact('schoolinventory', 'schools', 'logistics'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Schoolinventory id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schoolinventory = $this->Schoolinventories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schoolinventory = $this->Schoolinventories->patchEntity($schoolinventory, $this->request->getData());
            if ($this->Schoolinventories->save($schoolinventory)) {
                $this->Flash->success(__('The schoolinventory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The schoolinventory could not be saved. Please, try again.'));
        }
        $schools = $this->Schoolinventories->Schools->find('list', ['limit' => 200]);
        $logistics = $this->Schoolinventories->Logistics->find('list', ['limit' => 200]);
        $this->set(compact('schoolinventory', 'schools', 'logistics'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Schoolinventory id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schoolinventory = $this->Schoolinventories->get($id);
        if ($this->Schoolinventories->delete($schoolinventory)) {
            $this->Flash->success(__('The schoolinventory has been deleted.'));
        } else {
            $this->Flash->error(__('The schoolinventory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
