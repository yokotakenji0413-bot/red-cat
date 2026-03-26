<h1 style="margin-bottom: 30px;">商品登録</h1>

<div style="max-width: 800px; margin: 0 auto;">

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- 商品名 -->
        <div style="margin-bottom: 20px;">
            <label>
                商品名
                <span style="color:red; font-size:12px;">必須</span>
            </label><br>

            <input type="text" name="name" value="{{ old('name') }}"
                placeholder="商品名を入力"
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">

            @error('name')
            <p style="color:red; font-size:12px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- 値段 -->
        <div style="margin-bottom: 20px;">
            <label>
                値段
                <span style="color:red; font-size:12px;">必須</span>
            </label><br>

            <input type="number" name="price" value="{{ old('price') }}"
                placeholder="値段を入力"
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">

            @error('price')
            <p style="color:red; font-size:12px;">{{ $message }}</p>
            @enderror
        </div>

        <!-- 商品画像 -->
        <div style="margin-bottom: 20px;">
            <label>
                商品画像
                <span style="color:red; font-size:12px;">必須</span>
            </label><br>

            <input type="file" name="image">

            @error('image')
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

            @foreach (['春', '夏', '秋', '冬'] as $season)
            <label style="margin-right: 15px;">
                <input type="checkbox" name="season[]" value="{{ $season }}"
                    {{ in_array($season, old('season', [])) ? 'checked' : '' }}>
                {{ $season }}
            </label>
            @endforeach

            @error('season')
            <p style="color:red; font-size:12px;">季節を選択してください</p>
            @enderror
        </div>

        <!-- 商品説明 -->
        <div style="margin-bottom: 20px;">
            <label>
                商品説明
                <span style="color:red; font-size:12px;">必須</span>
            </label><br>

            <textarea name="description" rows="5"
                placeholder="商品の説明を入力"
                style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">{{ old('description') }}</textarea>

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
                登録
            </button>

        </div>

    </form>

</div>