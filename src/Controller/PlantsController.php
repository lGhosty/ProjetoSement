<?php
declare(strict_types=1);

namespace App\Controller;

class PlantsController extends AppController
{
    public function index()
    {
        $plants = $this->paginate($this->Plants);

        $cartItems = $this->fetchTable('CartItems')->find('all')->toArray();
        $cartItemCount = 0;
        foreach ($cartItems as $item) {
            $cartItemCount += $item->quantity;
        }

        $this->set(compact('plants', 'cartItemCount'));
    }

    public function view($id = null)
    {
        $plant = $this->Plants->get($id, [
            'contain' => [],
        ]);
        $this->set(compact('plant'));
    }

    public function add()
    {
        $plant = $this->Plants->newEmptyEntity();
        if ($this->request->is('post')) {
            $plant = $this->Plants->patchEntity($plant, $this->request->getData());

            // --- CORREÇÃO APLICADA AQUI ---
            // Agora estamos lendo o campo 'image_file', que é o nome correto do campo no formulário.
            $image = $this->request->getData('image_file');

            if ($image && $image->getError() == UPLOAD_ERR_OK) {
                $fileName = $image->getClientFilename();
                $targetPath = WWW_ROOT . 'img' . DS . 'plants' . DS . $fileName;

                $image->moveTo($targetPath);
                $plant->image = $fileName;
            }
            // --- FIM DA CORREÇÃO ---

            if ($this->Plants->save($plant)) {
                $this->Flash->success(__('A planta foi salva.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A planta não pôde ser salva. Por favor, tente novamente.'));
        }
        $this->set(compact('plant'));
    }

    public function edit($id = null)
    {
        $plant = $this->Plants->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $plant = $this->Plants->patchEntity($plant, $this->request->getData());

            // --- CORREÇÃO APLICADA AQUI TAMBÉM ---
            $image = $this->request->getData('image_file');

            if ($image && $image->getError() == UPLOAD_ERR_OK) {
                $fileName = $image->getClientFilename();
                $targetPath = WWW_ROOT . 'img' . DS . 'plants' . DS . $fileName;
                
                $image->moveTo($targetPath);
                $plant->image = $fileName;
            }
            
            if ($this->Plants->save($plant)) {
                $this->Flash->success(__('A planta foi salva.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('A planta não pôde ser salva. Por favor, tente novamente.'));
        }
        $this->set(compact('plant'));
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $plant = $this->Plants->get($id);
        if ($this->Plants->delete($plant)) {
            $this->Flash->success(__('A planta foi deletada.'));
        } else {
            $this->Flash->error(__('A planta não pôde ser deletada. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}