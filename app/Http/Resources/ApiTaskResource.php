<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' =>$this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'priority' => $this->priority,
            'completed' => $this->completed,
            'completed_at' => (!$this->completed_at?->diffForHumans())?'in process':$this->completed_at->diffForHumans(),
            'todo_list_id' => $this->todo_list_id,
            'task_id' => $this->task_id ?? 'main task',
            'created_at' => $this->created_at->format('d-m-Y H:i'),
            'updated_at' => $this->updated_at->diffForHumans(),
            'subtask' => (!$request->without) ? ApiTaskResource::collection($this->subtask) : NULL,
        ];
    }
}
