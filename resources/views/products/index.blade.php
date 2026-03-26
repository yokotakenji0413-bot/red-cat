<h1 style="margin-bottom: 30px;">商品一覧</h1>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <div></div>
    <a href="{{ route('products.create') }}" style="
        background: #f5c542;
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
    ">
        + 商品を追加
    </a>
</div>

<div style="display: flex; gap: 30px;">

    <!-- 🔽 左：検索・並び替え -->
    <div style="width: 250px;">

        <form method="GET" action="{{ route('products.index') }}">

            <input type="text" name="keyword" placeholder="商品名で検索"
                value="{{ request('keyword') }}"
                style="
                width: 100%;
                padding: 10px;
                margin-bottom: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
            ">

            <button type="submit"
                style="
                width: 100%;
                background: gold;
                border: none;
                padding: 10px;
                border-radius: 5px;
                font-weight: bold;
                cursor: pointer;
            ">
                検索
            </button>

            <p style="margin-top: 20px;">価格順で表示</p>

            <select name="sort" onchange="this.form.submit()" style="
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        ">
                <option value="">価格で並べ替え</option>
                <option value="high" {{ request('sort') === 'high' ? 'selected' : '' }}>
                    高い順に表示
                </option>
                <option value="low" {{ request('sort') === 'low' ? 'selected' : '' }}>
                    低い順に表示
                </option>
            </select>

        </form>
    </div>

    <!-- 🔽 右：商品一覧 -->
    <div style="flex: 1;">

        <div style="
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
    ">

            @forelse ($products as $product)
            <div style="
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        ">

                <!-- 画像 -->
                <img src="{{ asset('storage/' . $product->image) }}"
                    style="
        width: 100%;
        height: 180px;
        object-fit: cover;
    ">

                <div style="padding: 15px;">

                    <!-- 商品名＋価格 -->
                    <div style="
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 10px;
                ">
                        <p style="font-weight: bold; font-size: 16px;">
                            {{ $product->name }}
                        </p>

                        <p style="color: #555; font-size: 14px;">
                            ¥{{ number_format($product->price) }}
                        </p>
                    </div>

                    <!-- 🌸 季節バッジ -->
                    <div style="margin-bottom: 10px;">
                        @php
                        if (is_array($product->season)) {
                        $seasons = $product->season;
                        } else {
                        $seasons = json_decode($product->season, true) ?? [];
                        }
                        @endphp

                        @foreach ($seasons as $season)
                        <span style="
                        display: inline-block;
                        padding: 6px 12px;
                        margin-right: 6px;
                        border-radius: 20px;
                        font-size: 12px;
                        font-weight: bold;
                        color: white;

                        @if($season === '春') background:#ff7eb9;
                        @elseif($season === '夏') background:#ffa500;
                        @elseif($season === '秋') background:#8b4513;
                        @elseif($season === '冬') background:#4da3ff;
                        @endif
                    ">
                            {{ $season }}
                        </span>
                        @endforeach
                    </div>

                    <!-- ボタン -->
                    <div style="display: flex; gap: 10px;">

                        <!-- 編集 -->
                        <a href="{{ route('products.edit', $product->id) }}"
                            style="
                            flex: 1;
                            text-align: center;
                            background: #4CAF50;
                            color: white;
                            padding: 8px;
                            border-radius: 6px;
                            text-decoration: none;
                            font-size: 13px;
                            font-weight: bold;
                        ">
                            編集
                        </a>

                        <!-- 削除 -->
                        <form action="{{ route('products.destroy', $product->id) }}"
                            method="POST" style="flex:1;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('本当に削除しますか？')"
                                style="
                                width: 100%;
                                background: #ff4d4d;
                                color: white;
                                border: none;
                                padding: 8px;
                                border-radius: 6px;
                                font-size: 13px;
                                cursor: pointer;
                                font-weight: bold;
                            ">
                                削除
                            </button>
                        </form>

                    </div>

                </div>
            </div>

            @empty
            <p style="padding: 20px;">商品が見つかりません</p>
            @endforelse

        </div>

        <!-- ページネーション -->
        <div style="margin-top: 30px;">
            {{ $products->links() }}
        </div>

    </div>

</div>