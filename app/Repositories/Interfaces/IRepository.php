<?php


namespace App\Repositorys\Interfaces;


interface IRepository
{
    public function all($per_page);

    public function create(array  $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id);

    public function allNotPaginated();
}
