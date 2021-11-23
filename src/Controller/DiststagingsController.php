<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Diststagings Controller
 *
 * @property \App\Model\Table\DiststagingsTable $Diststagings
 * @method \App\Model\Entity\Diststaging[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DiststagingsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $diststagings = $this->paginate($this->Diststagings);

        $this->set(compact('diststagings'));
    }

    /**
     * View method
     *
     * @param string|null $id Diststaging id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $diststaging = $this->Diststagings->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('diststaging'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $diststaging = $this->Diststagings->newEmptyEntity();
        if ($this->request->is('post')) {
            $diststaging = $this->Diststagings->patchEntity($diststaging, $this->request->getData());
            if ($this->Diststagings->save($diststaging)) {
                $this->Flash->success(__('The diststaging has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The diststaging could not be saved. Please, try again.'));
        }
        $this->set(compact('diststaging'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Diststaging id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $diststaging = $this->Diststagings->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $diststaging = $this->Diststagings->patchEntity($diststaging, $this->request->getData());
            if ($this->Diststagings->save($diststaging)) {
                $this->Flash->success(__('The diststaging has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The diststaging could not be saved. Please, try again.'));
        }
        $this->set(compact('diststaging'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Diststaging id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $diststaging = $this->Diststagings->get($id);
        if ($this->Diststagings->delete($diststaging)) {
            $this->Flash->success(__('The diststaging has been deleted.'));
        } else {
            $this->Flash->error(__('The diststaging could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
