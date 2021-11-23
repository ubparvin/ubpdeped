<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Productimages Controller
 *
 * @property \App\Model\Table\ProductimagesTable $Productimages
 * @method \App\Model\Entity\Productimage[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductimagesController extends AppController
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
        $productimages = $this->paginate($this->Productimages);

        $this->set(compact('productimages'));
    }

    /**
     * View method
     *
     * @param string|null $id Productimage id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productimage = $this->Productimages->get($id, [
            'contain' => ['Products'],
        ]);

        $this->set(compact('productimage'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productimage = $this->Productimages->newEmptyEntity();
        if ($this->request->is('post')) {
            $productimage = $this->Productimages->patchEntity($productimage, $this->request->getData());
            if ($this->Productimages->save($productimage)) {
                $this->Flash->success(__('The productimage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The productimage could not be saved. Please, try again.'));
        }
        $products = $this->Productimages->Products->find('list', ['limit' => 200]);
        $this->set(compact('productimage', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Productimage id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productimage = $this->Productimages->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productimage = $this->Productimages->patchEntity($productimage, $this->request->getData());
            if ($this->Productimages->save($productimage)) {
                $this->Flash->success(__('The productimage has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The productimage could not be saved. Please, try again.'));
        }
        $products = $this->Productimages->Products->find('list', ['limit' => 200]);
        $this->set(compact('productimage', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Productimage id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productimage = $this->Productimages->get($id);
        if ($this->Productimages->delete($productimage)) {
            $this->Flash->success(__('The productimage has been deleted.'));
        } else {
            $this->Flash->error(__('The productimage could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
