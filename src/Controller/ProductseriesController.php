<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Productseries Controller
 *
 * @property \App\Model\Table\ProductseriesTable $Productseries
 * @method \App\Model\Entity\Productseries[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductseriesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Products'],
        ];
        $productseries = $this->paginate($this->Productseries);

        $this->set(compact('productseries'));
    }

    /**
     * View method
     *
     * @param string|null $id Productseries id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productseries = $this->Productseries->get($id, [
            'contain' => ['Products'],
        ]);

        $this->set(compact('productseries'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productseries = $this->Productseries->newEmptyEntity();
        if ($this->request->is('post')) {
            $productseries = $this->Productseries->patchEntity($productseries, $this->request->getData());
            if ($this->Productseries->save($productseries)) {
                $this->Flash->success(__('The productseries has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The productseries could not be saved. Please, try again.'));
        }
        $products = $this->Productseries->Products->find('list', ['limit' => 200]);
        $this->set(compact('productseries', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Productseries id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productseries = $this->Productseries->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productseries = $this->Productseries->patchEntity($productseries, $this->request->getData());
            if ($this->Productseries->save($productseries)) {
                $this->Flash->success(__('The productseries has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The productseries could not be saved. Please, try again.'));
        }
        $products = $this->Productseries->Products->find('list', ['limit' => 200]);
        $this->set(compact('productseries', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Productseries id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productseries = $this->Productseries->get($id);
        if ($this->Productseries->delete($productseries)) {
            $this->Flash->success(__('The productseries has been deleted.'));
        } else {
            $this->Flash->error(__('The productseries could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
