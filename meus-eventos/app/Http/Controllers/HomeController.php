<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class HomeController extends Controller
{
    private Event $event;

    /**
     * HomeController constructor.
     * @param Event $event
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * @return View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(): View
    {
        $byCategory = request()->has('category')
            ? Category::whereSlug(request()->get('category'))->first()->events() : null;

        $events = $this->event->getEventsHome($byCategory)->paginate(6);
        $categories = Category::all(['name', 'slug']);

        return view('home', compact('events'));
    }

    /**
     * @param Event $event
     * @return View
     */
    public function show(Event $event): view
    {
        return view('event', compact('event'));
    }
}
