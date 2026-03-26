<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 一覧表示（検索・並び替え）
    public function index(Request $request)
    {
        $query = Product::query();

        // 🔍 検索
        if (!empty($request->keyword)) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // 🔽 並び替え
        if ($request->sort === 'high') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort === 'low') {
            $query->orderBy('price', 'asc');
        }

        $products = $query->paginate(6);

        return view('products.index', compact('products'));
    }

    // 作成画面
    public function create()
    {
        return view('products.create');
    }

    // 保存処理
    public function store(Request $request)
    {
        // ✅ バリデーション
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|integer|min:0|max:10000',
            'description' => 'required|max:120',
            'image' => 'required|image|mimes:png,jpeg',
            'season' => 'required|array',
        ], [
            'name.required' => '商品名を入力してください',
            'price.required' => '値段を入力してください',
            'price.integer' => '数値で入力してください',
            'price.max' => '0〜10000円以内で入力してください',
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
            'image.required' => '商品画像を登録してください',
            'image.mimes' => 'png または jpeg 形式でアップロードしてください',
            'season.required' => '季節を選択してください',
        ]);

        // データ取得
        $data = $request->only(['name', 'price', 'description']);

        // 季節（JSON保存）
        $data['season'] = json_encode($request->season);

        // 画像アップロード
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // 保存
        Product::create($data);

        return redirect()
            ->route('products.index')
            ->with('success', '商品を登録しました');
    }

    // 編集画面
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        // JSON → 配列変換
        $product->season = json_decode($product->season, true) ?? [];

        return view('products.edit', compact('product'));
    }

    // 更新処理
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|integer|min:0',
            'description' => 'required|max:120',
            'image' => 'nullable|image',
            'season' => 'required|array',
        ]);

        $data = $request->only(['name', 'price', 'description']);

        // 🔥 ここ超重要
        $data['season'] = json_encode($request->input('season', []));

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', '商品を更新しました');
    }

    // 削除
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // 画像削除
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', '商品を削除しました');
    }
}
