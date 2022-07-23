<div class="w-full mb-3">
    <label for="name">Nama</label>
    <input class="form" id="name" placeholder="Tube #1" type="text" x-model="detail.name">
</div>

<div class="flex w-full space-x-3 mb-3">

    <div class="w-2/6">
        <label for="weight">Lebar</label>
        <input class="form" id="weight" step="2" value="20" type="number" x-model="detail.weight">
    </div>

    <div class="w-2/6">
        <label for="opacity">Opacity</label>
        <input class="form" id="opacity" value="0.7" step="0.1" max="1" min="0.1" type="number" x-model="detail.opacity">
    </div>

    <div class="w-2/6">
        <label for="color">Warna</label>
        <input class="form h-[42px] p-1" id="color" type="color" x-model="detail.color">
    </div>
</div>

<div class="mb-5">
    <label for="email">DESKRIPSI</label>
    <textarea class="form" id="email" rows="5" x-model="detail.description"></textarea>
</div>
