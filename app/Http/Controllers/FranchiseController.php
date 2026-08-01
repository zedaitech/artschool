<?php

namespace App\Http\Controllers;

class FranchiseController extends Controller
{
    /**
     * The franchise prospectus. Entirely copy-driven — the offer, the support
     * on offer and the rules all live in messages.franchise, and the numbers
     * in config/franchise.php — so there is nothing to load from the database.
     */
    public function show()
    {
        return view('pages.franchise');
    }
}
