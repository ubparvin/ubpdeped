<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Warehouseinventories Controller
 *
 * @property \App\Model\Table\WarehouseinventoriesTable $Warehouseinventories
 * @method \App\Model\Entity\Warehouseinventory[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WarehouseinventoriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Warehouses', 'Logistics'],
        ];
        $warehouseinventories = $this->paginate($this->Warehouseinventories);

        $this->set(compact('warehouseinventories'));
    }

    /**
     * View method
     *
     * @param string|null $id Warehouseinventory id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $warehouseinventory = $this->Warehouseinventories->get($id, [
            'contain' => ['Warehouses', 'Logistics'],
        ]);

        $this->set(compact('warehouseinventory'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $warehouseinventory = $this->Warehouseinventories->newEmptyEntity();
        if ($this->request->is('post')) {
            $warehouseinventory = $this->Warehouseinventories->patchEntity($warehouseinventory, $this->request->getData());
            if ($this->Warehouseinventories->save($warehouseinventory)) {
                $this->Flash->success(__('The warehouseinventory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The warehouseinventory could not be saved. Please, try again.'));
        }
        $warehouses = $this->Warehouseinventories->Warehouses->find('list', ['limit' => 200]);
        $logistics = $this->Warehouseinventories->Logistics->find('list', ['limit' => 200]);
        $this->set(compact('warehouseinventory', 'warehouses', 'logistics'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Warehouseinventory id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $warehouseinventory = $this->Warehouseinventories->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $warehouseinventory = $this->Warehouseinventories->patchEntity($warehouseinventory, $this->request->getData());
            if ($this->Warehouseinventories->save($warehouseinventory)) {
                $this->Flash->success(__('The warehouseinventory has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The warehouseinventory could not be saved. Please, try again.'));
        }
        $warehouses = $this->Warehouseinventories->Warehouses->find('list', ['limit' => 200]);
        $logistics = $this->Warehouseinventories->Logistics->find('list', ['limit' => 200]);
        $this->set(compact('warehouseinventory', 'warehouses', 'logistics'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Warehouseinventory id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $warehouseinventory = $this->Warehouseinventories->get($id);
        if ($this->Warehouseinventories->delete($warehouseinventory)) {
            $this->Flash->success(__('The warehouseinventory has been deleted.'));
        } else {
            $this->Flash->error(__('The warehouseinventory could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
