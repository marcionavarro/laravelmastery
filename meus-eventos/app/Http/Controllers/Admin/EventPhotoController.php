<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventPhotoRequest;
use App\Models\Event;
use App\Services\MessageService;
use App\Traits\UploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class EventPhotoController extends Controller
{

    use UploadTrait;

    private $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
        $this->middleware('user.can.event.edit');
    }

    /**
     * Display a listing of the resource.
     *
     * @param $event
     * @return string
     */
    public function index(Event $event): string
    {
        $photos = $event->photos()->paginate(8);
        return view('admin.events.photos', compact('event', 'photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EventPhotoRequest $request
     * @param Event $event
     * @return RedirectResponse
     */
    public function store(EventPhotoRequest $request, Event $event): RedirectResponse
    {
        $uploadedPhotos = $this->multipleFilesUpload($request->file('photos'), 'events/photos', 'photo');
        $event->photos()->createMany($uploadedPhotos);

        MessageService::addFlash('success', 'Foto(s) adicionada(s) com sucesso!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @param $photo
     * @return RedirectResponse
     */
    public function destroy(Event $event, $photo): RedirectResponse
    {
        $photo = $event->photos()->find($photo);

        if (!$photo) {
            return redirect()->route('admin.events.index');
        }

        if (Storage::disk('public')->exists($photo->photo)) {
            Storage::disk('public')->delete($photo->photo);
        }

        $photo->delete();

        MessageService::addFlash('success', 'Foto(s) removida(s) com sucesso!');
        return redirect()->back();
    }
}
