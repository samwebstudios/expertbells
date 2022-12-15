<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class LeftPanel extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $homemanagement;
    public $others;
    public $schedules;
    public function __construct()
    {
        $this->homemanagement = [''];
        $this->schedules = ['rejected','booked','expired'];
        $this->others = ['qualifications','expertise','language','industry','role','working','getbetter','hearabout'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.left-panel');
    }
}
