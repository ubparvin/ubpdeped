<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Distributionitems Controller
 *
 * @property \App\Model\Table\DistributionitemsTable $Distributionitems
 * @method \App\Model\Entity\Distributionitem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DistributionitemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Distributions', 'Products', 'Programs'],
        ];
        $distributionitems = $this->paginate($this->Distributionitems);

        $this->set(compact('distributionitems'));
    }

    /**
     * View method
     *
     * @param string|null $id Distributionitem id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $distributionitem = $this->Distributionitems->get($id, [
            'contain' => ['Distributions', 'Products', 'Programs'],
        ]);

        $this->set(compact('distributionitem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $distributionitem = $this->Distributionitems->newEmptyEntity();
        if ($this->request->is('post')) {
            $distributionitem = $this->Distributionitems->patchEntity($distributionitem, $this->request->getData());
            if ($this->Distributionitems->save($distributionitem)) {
                $this->Flash->success(__('The distributionitem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The distributionitem could not be saved. Please, try again.'));
        }
        $distributions = $this->Distributionitems->Distributions->find('list', ['limit' => 200]);
        $products = $this->Distributionitems->Products->find('list', ['limit' => 200]);
        $programs = $this->Distributionitems->Programs->find('list', ['limit' => 200]);
        $this->set(compact('distributionitem', 'distributions', 'products', 'programs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Distributionitem id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $distributionitem = $this->Distributionitems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $distributionitem = $this->Distributionitems->patchEntity($distributionitem, $this->request->getData());
            if ($this->Distributionitems->save($distributionitem)) {
                $this->Flash->success(__('The distributionitem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The distributionitem could not be saved. Please, try again.'));
        }
        $distributions = $this->Distributionitems->Distributions->find('list', ['limit' => 200]);
        $products = $this->Distributionitems->Products->find('list', ['limit' => 200]);
        $programs = $this->Distributionitems->Programs->find('list', ['limit' => 200]);
        $this->set(compact('distributionitem', 'distributions', 'products', 'programs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Distributionitem id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $distributionitem = $this->Distributionitems->get($id);
        if ($this->Distributionitems->delete($distributionitem)) {
            $this->Flash->success(__('The distributionitem has been deleted.'));
        } else {
            $this->Flash->error(__('The distributionitem could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
