<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Logistictrans Controller
 *
 * @property \App\Model\Table\LogistictransTable $Logistictrans
 * @method \App\Model\Entity\Logistictran[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogistictransController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Logistics'],
        ];
        $logistictrans = $this->paginate($this->Logistictrans);

        $this->set(compact('logistictrans'));
    }

    /**
     * View method
     *
     * @param string|null $id Logistictran id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $logistictran = $this->Logistictrans->get($id, [
            'contain' => ['Logistics'],
        ]);

        $this->set(compact('logistictran'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $logistictran = $this->Logistictrans->newEmptyEntity();
        if ($this->request->is('post')) {
            $logistictran = $this->Logistictrans->patchEntity($logistictran, $this->request->getData());
            if ($this->Logistictrans->save($logistictran)) {
                $this->Flash->success(__('The logistictran has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The logistictran could not be saved. Please, try again.'));
        }
        $logistics = $this->Logistictrans->Logistics->find('list', ['limit' => 200]);
        $this->set(compact('logistictran', 'logistics'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Logistictran id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $logistictran = $this->Logistictrans->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $logistictran = $this->Logistictrans->patchEntity($logistictran, $this->request->getData());
            if ($this->Logistictrans->save($logistictran)) {
                $this->Flash->success(__('The logistictran has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The logistictran could not be saved. Please, try again.'));
        }
        $logistics = $this->Logistictrans->Logistics->find('list', ['limit' => 200]);
        $this->set(compact('logistictran', 'logistics'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Logistictran id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $logistictran = $this->Logistictrans->get($id);
        if ($this->Logistictrans->delete($logistictran)) {
            $this->Flash->success(__('The logistictran has been deleted.'));
        } else {
            $this->Flash->error(__('The logistictran could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
