<?php
namespace CodeOrders\V1\Rest\Clients;

use ZF\ApiProblem\ApiProblem;
use CodeOrders\V1\Abstracts\ResourceAbstract;

class ClientsResource extends ResourceAbstract
{

    /**
     * @var ClientsRepository
     */
    private $repository;

    public function __construct(ClientsRepository $repository) {
        
        $this->repository = $repository;
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
        if ($usuarioLogado->getRole() === 'admin') {
            $user = $this->repository->insert($data);
            return $user;
        }else{
            return new ApiProblem(403, "Apenas usuários 'admin' podem adicionar produtos");
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
        $usuarioLogado = $this->getUsuarioLogado();
        if ($usuarioLogado->getRole() === 'admin') {
            $retorno = $this->repository->delete($id);
            return $retorno;
        }else{
            return new ApiProblem(403, "Apenas usuários 'admin' podem excluir produtos");
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
        return $this->repository->find($id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
        return $this->repository->findAll();
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
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
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
        $usuarioLogado = $this->getUsuarioLogado();
        if ($usuarioLogado->getRole() === 'admin') {
            return $this->repository->update($id, $data);
        }else{
            return new ApiProblem(403, "Apenas usuários 'admin' podem editar os produtos");
        }
    }
}
