<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Services\MessageService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadTrait;


class EventController extends Controller
{
    use UploadTrait;

    private Event $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
        $this->middleware('user.can.event.edit')->only('edit', 'update');
    }

    public function index()
    {
        $events = auth()->user()->events()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    /**
     * @param Event $event
     * @return string
     */
    public function show(Event $event): string
    {
        return 'Evento' . $event;
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $categories = Category::all(['id', 'name']);
        return view('admin.events.create', compact('categories'));
    }

    /**
     * @param EventRequest $request
     * @return RedirectResponse
     */
    public function store(EventRequest $request): RedirectResponse
    {
        $event = $request->all();

        if ($banner = $request->file('banner')) {
            $event['banner'] = $this->upload($banner, 'events/banner');
        }


        $event['slug'] = $event['title'];

        $event = $this->event->create($event);
        $event->user()->associate(auth()->user());
        $event->save();

        if ($categories = $request->get('categories')) {
            $event->categories()->sync($categories);
        }

        MessageService::addFlash('success', 'Evento criado com sucesso!');
        return redirect()->route('admin.events.index');
    }

    /**
     * @param Event $event
     * @return View
     */
    public function edit(Event $event): View
    {
        $categories = Category::all(['id', 'name']);
        return view('admin.events.edit', compact('event', 'categories'));
    }


    /**
     * @param Event $event
     * @param EventRequest $request
     * @return RedirectResponse
     */
    public function update(Event $event, EventRequest $request): RedirectResponse
    {
        $eventData = $request->all();

        if ($banner = $request->file('banner')) {
            if (!empty($event->banner)) {
                if (Storage::disk('public')->exists($event->banner)) {
                    Storage::disk('public')->delete($event->banner);
                }
            }

            $eventData['banner'] = $this->upload($banner, 'events/banner');
        }

        $event->update($eventData);

        if ($categories = $request->get('categories')) {
            $event->categories()->sync($categories);
        }

        MessageService::addFlash('success', 'Evento atualizado com sucesso!');
        return redirect()->back();
    }

    /**
     * @param Event $event
     * @return RedirectResponse
     */
    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();
        MessageService::addFlash('success', 'Evento removido com sucesso!');
        return redirect()->route('admin.events.index');
    }
}
