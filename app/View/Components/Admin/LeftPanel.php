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
    public $helpcenter;
    public $aboutus;
    public function __construct()
    {
        $this->homemanagement = [''];
        $this->helpcenter = ['help-center','add-help-center','edit-help-center','help-center-query'];
        $this->schedules = ['rejected','booked','expired'];
        $this->aboutus = ['teams','about','mission','vission','teamcms','addteams','editteams','privacy-policy','terms-condition'];
        $this->others = ['qualifications','expert-category','expertise','language','industry','role','working','getbetter','hearabout'];
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
