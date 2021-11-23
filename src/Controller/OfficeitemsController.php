<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Officeitems Controller
 *
 * @property \App\Model\Table\OfficeitemsTable $Officeitems
 * @method \App\Model\Entity\Officeitem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OfficeitemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Schools', 'Products'],
        ];
        $officeitems = $this->paginate($this->Officeitems);

        $this->set(compact('officeitems'));
    }

    /**
     * View method
     *
     * @param string|null $id Officeitem id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $officeitem = $this->Officeitems->get($id, [
            'contain' => ['Schools', 'Products'],
        ]);

        $this->set(compact('officeitem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $officeitem = $this->Officeitems->newEmptyEntity();
        if ($this->request->is('post')) {
            $officeitem = $this->Officeitems->patchEntity($officeitem, $this->request->getData());
            if ($this->Officeitems->save($officeitem)) {
                $this->Flash->success(__('The officeitem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The officeitem could not be saved. Please, try again.'));
        }
        $schools = $this->Officeitems->Schools->find('list', ['limit' => 200]);
        $products = $this->Officeitems->Products->find('list', ['limit' => 200]);
        $this->set(compact('officeitem', 'schools', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Officeitem id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $officeitem = $this->Officeitems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $officeitem = $this->Officeitems->patchEntity($officeitem, $this->request->getData());
            if ($this->Officeitems->save($officeitem)) {
                $this->Flash->success(__('The officeitem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The officeitem could not be saved. Please, try again.'));
        }
        $schools = $this->Officeitems->Schools->find('list', ['limit' => 200]);
        $products = $this->Officeitems->Products->find('list', ['limit' => 200]);
        $this->set(compact('officeitem', 'schools', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Officeitem id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $officeitem = $this->Officeitems->get($id);
        if ($this->Officeitems->delete($officeitem)) {
            $this->Flash->success(__('The officeitem has been deleted.'));
        } else {
            $this->Flash->error(__('The officeitem could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
