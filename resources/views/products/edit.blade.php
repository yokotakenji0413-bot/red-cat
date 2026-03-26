<h1 style="margin-bottom: 30px;">商品詳細</h1>

<div style="max-width: 1000px; margin: 0 auto;">

    <!-- パンくず -->
    <p style="color: #888; margin-bottom: 20px;">
        <a href="{{ route('products.index') }}" style="color:#4da3ff;">商品一覧</a>
        ＞ {{ $product->name }}
    </p>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- 上：画像＋入力 -->
        <div style="display: flex; gap: 40px;">

            <!-- 左：画像 -->
            <div style="width: 40%;">
                <img src="{{ asset('storage/' . $product->image) }}"
                    style="width: 100%; border-radius: 10px; margin-bottom: 10px;">
                <input type="file" name="image">

                @error('image')
                <p style="color:red; font-size:12px;">{{ $message }}</p>
                @enderror
            </div>

            <!-- 右：入力 -->
            <div style="flex: 1;">

                <!-- 商品名 -->
                <div style="margin-bottom: 20px;">
                    <label>
                        商品名
                        <span style="color:red; font-size:12px;">必須</span>
                    </label><br>

                    <input type="text" name="name"
                        value="{{ old('name', $product->name) }}"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">

                    @error('name')
                    <p style="color:red; font-size:12px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 価格 -->
                <div style="margin-bottom: 20px;">
                    <label>
                        値段
                        <span style="color:red; font-size:12px;">必須</span>
                    </label><br>

                    <input type="number" name="price"
                        value="{{ old('price', $product->price) }}"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">

                    @error('price')
                    <p style="color:red; font-size:12px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 季節 -->
                <div style="margin-bottom: 20px;">
                    <label>
                        季節
                        <span style="color:red; font-size:12px;">必須</span>
                        <span style="color:red; font-size:12px;">（複数選択可）</span>
                    </label><br>

                    @php
                    $seasons = old('season', is_array($product->season)
                    ? $product->season
                    : json_decode($product->season, true) ?? []);
                    @endphp

                    @foreach (['春', '夏', '秋', '冬'] as $season)
                    <label style="margin-right: 15px;">
                        <input type="checkbox" name="season[]" value="{{ $season }}"
                            {{ in_array($season, $seasons) ? 'checked' : '' }}>
                        {{ $season }}
                    </label>
                    @endforeach

                    @error('season')
                    <p style="color:red; font-size:12px;">季節を選択してください</p>
                    @enderror
                </div>

            </div>
        </div>

        <!-- 商品説明 -->
        <div style="margin-top: 30px;">
            <label>
                商品説明
                <span style="color:red; font-size:12px;">必須</span>
            </label><br>

            <textarea name="description" rows="5"
                style="
                    width: 100%;
                    padding: 15px;
                    border: 1px solid #ddd;
                    border-radius: 8px;
                ">{{ old('description', $product->description) }}</textarea>

            @error('description')
            <p style="color:red; font-size:12px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- ボタン -->
        <div style="margin-top: 30px; display: flex; justify-content: center; gap: 20px;">

            <a href="{{ route('products.index') }}"
                style="
                    background: #ccc;
                    padding: 10px 30px;
                    border-radius: 5px;
                    text-decoration: none;
                    color: black;
                ">
                戻る
            </a>

            <button type="submit"
                style="
                    background: gold;
                    border: none;
                    padding: 10px 30px;
                    border-radius: 5px;
                    font-weight: bold;
                    cursor: pointer;
                ">
                変更を保存
            </button>

        </div>

    </form>

    <!-- 削除ボタン -->
    <div style="text-align: right; margin-top: 15px;">
        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit"
                onclick="return confirm('本当に削除しますか？')"
                style="background: none; border: none; cursor: pointer;">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="#ff4d4d" viewBox="0 0 24 24">
                    <path d="M9 3V4H4V6H20V4H15V3H9ZM6 7V19C6 20.1 6.9 21 8 21H16C17.1 21 18 20.1 18 19V7H6ZM8 9H10V17H8V9ZM14 9H16V17H14V9Z" />
                </svg>

            </button>
        </form>
    </div>

</div>