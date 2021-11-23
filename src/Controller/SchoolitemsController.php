<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Schoolitems Controller
 *
 * @property \App\Model\Table\SchoolitemsTable $Schoolitems
 * @method \App\Model\Entity\Schoolitem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SchoolitemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        /*$this->paginate = [
            'contain' => ['Schools', 'Products'],
        ];
        $schoolitems = $this->paginate($this->Schoolitems);*/
        $schoolitems = $this->Schoolitems->find('all', [
			'contain' => ['Schools']
		]);

        $this->set(compact('schoolitems'));
    }

    /**
     * View method
     *
     * @param string|null $id Schoolitem id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schoolitem = $this->Schoolitems->get($id, [
            'contain' => ['Schools', 'Products'],
        ]);

        $this->set(compact('schoolitem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $schoolitem = $this->Schoolitems->newEmptyEntity();
        if ($this->request->is('post')) {
            $schoolitem = $this->Schoolitems->patchEntity($schoolitem, $this->request->getData());
            if ($this->Schoolitems->save($schoolitem)) {
                $this->Flash->success(__('The schoolitem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The schoolitem could not be saved. Please, try again.'));
        }
        $schools = $this->Schoolitems->Schools->find('list', ['limit' => 200]);
        $products = $this->Schoolitems->Products->find('list', ['limit' => 200]);
        $this->set(compact('schoolitem', 'schools', 'products'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Schoolitem id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schoolitem = $this->Schoolitems->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schoolitem = $this->Schoolitems->patchEntity($schoolitem, $this->request->getData());
            if ($this->Schoolitems->save($schoolitem)) {
                $this->Flash->success(__('The schoolitem has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The schoolitem could not be saved. Please, try again.'));
        }
        $schools = $this->Schoolitems->Schools->find('list', ['limit' => 200]);
        $products = $this->Schoolitems->Products->find('list', ['limit' => 200]);
        $this->set(compact('schoolitem', 'schools', 'products'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Schoolitem id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schoolitem = $this->Schoolitems->get($id);
        if ($this->Schoolitems->delete($schoolitem)) {
            $this->Flash->success(__('The schoolitem has been deleted.'));
        } else {
            $this->Flash->error(__('The schoolitem could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
