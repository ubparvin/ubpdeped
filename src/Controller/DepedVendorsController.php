<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * DepedVendors Controller
 *
 * @property \App\Model\Table\DepedVendorsTable $DepedVendors
 * @method \App\Model\Entity\DepedVendor[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DepedVendorsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Barangays', 'Cities', 'Provinces', 'Regions'],
        ];
        $depedVendors = $this->paginate($this->DepedVendors);

        $this->set(compact('depedVendors'));
    }

    /**
     * View method
     *
     * @param string|null $id Deped Vendor id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $depedVendor = $this->DepedVendors->get($id, [
            'contain' => ['Barangays', 'Cities', 'Provinces', 'Regions'],
        ]);

        $this->set(compact('depedVendor'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $depedVendor = $this->DepedVendors->newEmptyEntity();
        if ($this->request->is('post')) {
            $depedVendor = $this->DepedVendors->patchEntity($depedVendor, $this->request->getData());
            if ($this->DepedVendors->save($depedVendor)) {
                $this->Flash->success(__('The deped vendor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The deped vendor could not be saved. Please, try again.'));
        }
        $barangays = $this->DepedVendors->Barangays->find('list', ['limit' => 200]);
        $cities = $this->DepedVendors->Cities->find('list', ['limit' => 200]);
        $provinces = $this->DepedVendors->Provinces->find('list', ['limit' => 200]);
        $regions = $this->DepedVendors->Regions->find('list', ['limit' => 200]);
        $this->set(compact('depedVendor', 'barangays', 'cities', 'provinces', 'regions'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Deped Vendor id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $depedVendor = $this->DepedVendors->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $depedVendor = $this->DepedVendors->patchEntity($depedVendor, $this->request->getData());
            if ($this->DepedVendors->save($depedVendor)) {
                $this->Flash->success(__('The deped vendor has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The deped vendor could not be saved. Please, try again.'));
        }
        $barangays = $this->DepedVendors->Barangays->find('list', ['limit' => 200]);
        $cities = $this->DepedVendors->Cities->find('list', ['limit' => 200]);
        $provinces = $this->DepedVendors->Provinces->find('list', ['limit' => 200]);
        $regions = $this->DepedVendors->Regions->find('list', ['limit' => 200]);
        $this->set(compact('depedVendor', 'barangays', 'cities', 'provinces', 'regions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Deped Vendor id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $depedVendor = $this->DepedVendors->get($id);
        if ($this->DepedVendors->delete($depedVendor)) {
            $this->Flash->success(__('The deped vendor has been deleted.'));
        } else {
            $this->Flash->error(__('The deped vendor could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
