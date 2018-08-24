<?php

namespace App\Http\ViewComposers;

use App\Models\ManageRole;
use App\Models\ManageUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MenuComposer
{
    /**
     * The current logged in user.
     *
     * @var ManageUser
     */
    protected $user;

    /**
     * Create a new menu composer.
     * @param ManageUser $user
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $items = [];
        if($this->user){
            if($this->user->isRole(ManageRole::ROLE_ADMIN)) {
                $items[] = new MenuItem(' ユーザー管理', route('listUser'), 'user', '/user');
            }
        }
        $view->with('items', $items);
    }
}

/**
 * Prototype class for menu item
 *
 * Class MenuItem
 * @package App\Http\ViewComposers
 */
class MenuItem
{
    public $title;
    public $url;
    public $icon;
    public $prefix;

    public function __construct($title, $url, $icon = '', $prefix = false)
    {
        $this->title = $title;
        $this->url = $url;
        $this->icon = $icon;
        $this->prefix = $prefix;
    }

    public static function createNew()
    {
        return new static('Untitle', '#', '', '');
    }
}