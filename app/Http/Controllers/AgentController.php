<?php

namespace App\Http\Controllers;

use App\Http\Requests\Agent\AgentStore;
use App\Http\Requests\Agent\AgentUpdate;
use App\Models\Agent;
use App\Http\Controllers\Controller;
use App\Models\AgentProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $agent)
    {
        $agents = Agent::where('parent_id', $agent)->get();
        $products = Product::all();
        return view('pages.agent', ['models' => $agents, 'agent' => $agent, 'products' => $products]);
    }
    public function getAll()
    {
        $agents = Agent::where('parent_id', 0)->get();
        return view('pages.agents', ['models' => $agents]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgentStore $request)
    {
        $data = $request->all();
        Agent::create($data);
        return back()->with('success', 'Ma\'lumot qo\'shildi!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agent $agent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgentUpdate $request, Agent $agent)
    {
        $data = $request->all();
        $agent->update($data);
        return back()->with('warning', 'Ma\'lumot yangilandi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agent $agent)
    {
        $this->deleteAgentAndDescendants($agent);

        return back()->with('danger', 'Parent agent va children agentlar o\'chirildi!');
    }

    protected function deleteAgentAndDescendants(Agent $agent)
    {
        $children = $agent->children;

        foreach ($children as $child) {
            $this->deleteAgentAndDescendants($child);
        }

        $agent->delete();
    }

    public function addProduct(Request $request)
    {
        $parentId = $request->agent_id;
        $productId = $request->product_id;
        $price = $request->price;
        // dd($request->agent_id);

        if (!$parentId || !$productId || !$price) {
            return back()->withErrors(['danger' => 'Xatolik']);
        }

        $parentAgent = Agent::find($parentId);
        if (!$parentAgent) {
            return back()->withErrors(['danger' => 'Parent agent topilmadi']);
        }

        $this->attachProductToAgent($parentAgent, $productId, $price);
        $this->propagateProductPriceToChildren($parentAgent, $productId, $price);

        return back()->with('success', 'Product qo\'shildi');
    }

    protected function attachProductToAgent($agent, $productId, $price)
    {
        if (!$agent->agentProducts()->where('product_id', $productId)->exists()) {
            $agent->agentProducts()->attach($productId, ['price' => $price]);
        }
    }

    protected function propagateProductPriceToChildren($agent, $productId, $price)
    {
        foreach ($agent->children as $child) {
            $this->attachProductToAgent($child, $productId, $price);
            $this->propagateProductPriceToChildren($child, $productId, $price);
        }
    }

    

    public function updateProductOfAgent(Request $request)
{
    

    $parentId = $request->agent_id;
    $productId = $request->product_id;
    $price = $request->price;
    // dd($request->all());
    $parentAgent = Agent::find($parentId);

    if (!$parentAgent) {
        return back()->withErrors(['danger' => 'Parent agent topilmadi!']);
    }

    $this->syncProductWithAgent($parentAgent, $productId, $price);

    $this->propagateProductPriceToChildrens($parentAgent, $productId, $price);

    return back()->with('warning', 'Ma\'lumot yangilandi!');
}

protected function syncProductWithAgent($agent, $productId, $price)
{
    $agent->agentProducts()->syncWithoutDetaching([$productId => ['price' => $price]]);
}

protected function propagateProductPriceToChildrens($agent, $productId, $price)
{
    foreach ($agent->children as $child) {
        $this->syncProductWithAgent($child, $productId, $price);

        $this->propagateProductPriceToChildrens($child, $productId, $price);
    }
}

}
