<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\IndexRequest;
use App\Http\Requests\User\UpdateMultiRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\User\IndexResourceCollection;
use App\Http\Resources\User\ShowResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Service\UserService;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserController constructor.
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return JsonResponse
     */
    public function index(IndexRequest $request)
    {
        return response()->json(
            IndexResourceCollection::make($this->userService->list($request->validated()))
        );
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user)
    {
        return response()->json(ShowResource::make($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->validated());

        return response()->json(ShowResource::make($user));
    }

    /**
     * Update multi users
     *
     * @param UpdateMultiRequest $request
     * @param string $id
     * @return JsonResponse
     */
    public function updateMulti(UpdateMultiRequest $request, $id)
    {
        $this->userService->updateMulti($request->validated(), $id);

        return response()->json([
            'status' => 'ok',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'status' => 'ok',
        ]);
    }

    /**
     * Delete multi users
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroyMulti($id)
    {
        $this->userService->destroyMulti($id);

        return response()->json([
            'status' => 'ok',
        ]);
    }
}
