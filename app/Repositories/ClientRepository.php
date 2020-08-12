<?php


namespace App\Repositories;


use App\Address;
use App\Client;
use App\Helpers\General\CollectionHelper;
use App\Profile;
use App\Repositories\Interfaces\IClientRepository;

class ClientRepository implements IClientRepository
{

    /**
     * @var Address
     */
    private $model;

    public function __construct(Client $model)
    {
        $this->model = $model;
    }
    public function all($per_page)
    {
        $all =  $this->model->all();
        return CollectionHelper::paginate($all,$per_page);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        return $this->model->whereId($id)->update(
            $data
        );
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id)
    {
        $model = $this->model::with('addresses')->where('id',$id)->first();

        $profile = Profile::find($model->profile_id);

        $model['profile'] = $profile;
        if (null == $model ) {
            return null;
        }
        return $model;
    }

    public function allNotPaginated()
    {
        // TODO: Implement allNotPaginated() method.
    }

    public function search($id){
        $model = $this->model->find($id);

        if (null == $model ) {
            return null;
        }
        return $model;
    }
}
