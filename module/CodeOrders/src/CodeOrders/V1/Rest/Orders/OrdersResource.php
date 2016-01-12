<?php
namespace CodeOrders\V1\Rest\Orders;

use ZF\ApiProblem\ApiProblem;
use CodeOrders\V1\Abstracts\ResourceAbstract;

class OrdersResource extends ResourceAbstract 
{
    
    /**
     * @var OrdersService
     */
    private $service;

    /**
     * @var OrdersRepository
     */
    private $repository;

    public function __construct(OrdersRepository $repository, OrdersService $service) {

        $this->repository = $repository;
        
        $this->service = $service;
    }
    
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        $usuarioLogado = $this->getUsuarioLogado();
        if ($usuarioLogado->getRole() === 'salesman') {
            $result = $this->service->insert($data);
            if($result === 'error'){
                return new ApiProblem(400, 'Erro ao inserir pedido');
            }
            return $result;
        }else{
            return new ApiProblem(403, "Apenas usuários 'salesman' podem adicionar pedidos");
        }
        
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        $entity = $this->repository->find($id);
        $usuarioLogado = $this->getUsuarioLogado();
        if ($usuarioLogado->getRole() === 'admin' || $usuarioLogado->getId() === $entity['user_id']) {
            return $this->service->delete($id);
        }
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        $entity = $this->repository->find($id);
        $usuarioLogado = $this->getUsuarioLogado();
        if ($usuarioLogado->getRole() === 'admin' || $usuarioLogado->getId() === $entity['user_id']) {
            return $entity;
        }
        return new ApiProblem(403, "O usuário não pode acessar essa ordem");
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        $usuarioLogado = $this->getUsuarioLogado();
        if ($usuarioLogado->getRole() === 'salesman' ) {
            $params['user_id'] = $usuarioLogado->getId();
        }
        return $this->repository->findAll($params);
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return $this->service->update($id, $data);
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return $this->service->update($id, $data);
    }
}
