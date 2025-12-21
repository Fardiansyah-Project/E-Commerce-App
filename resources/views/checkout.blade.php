@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-5 py-10">

        <h2 class="text-3xl font-semibold mb-6">Membuat Pesanan</h2>
        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label class="block mb-2">Metode Pembayaran</label>
                    <select name="payment_method" class="w-full p-3 border rounded-xl">
                        <option disabled selected class="text-slate-600">--Pilih Metode--</option>
                        <option value="TRANSFER" {{ old('payment_method') == 'TRANSFER' ? 'selected' : '' }}>Transfer</option>
                        <option value="COD" {{ old('payment_method') == 'COD' ? 'selected' : '' }}>COD</option>
                    </select>
                    @error('payment_method')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label class="block mb-2">Alamat Pengiriman</label>
                    <textarea name="address" id="address" class="w-full border p-2 rounded-xl" rows="4"
                        placeholder="Masukkan alamat lengkap pengiriman">{{ old('address', auth()->user()->address) }}</textarea>
                    @error('address')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div id="proof" class="mb-5">
                    <p class="text-green-300 mb-1" style="display: none">
                        No Rek: xxx.xxx.xxx
                    </p>
                    <label class="block mb-2">Upload Bukti Transfer</label>
                    <input type="file" name="payment_proof" class="w-full border p-2 rounded-xl">
                    @error('payment_proof')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800">
                    Proses Pemesanan
                </button>
            </form>
        </div>

    </div>

    <script>
        document.querySelector('[name=payment_method]').addEventListener('change', e => {
            document.getElementById('proof').style.display =
                e.target.value === 'TRANSFER' ? 'block' : 'none';
        });
    </script>
    {{-- <x-app-layout title="Checkout">

    </x-app-layout> --}}
@endsection
