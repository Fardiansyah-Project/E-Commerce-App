@extends('layouts.app')
@section('content')
    <div class="container mx-auto px-5 py-10">
        <h2 class="text-3xl font-semibold mb-6">Membuat Pesanan</h2>

        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('payment-proof.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label class="block mb-3">Metode Pembayaran</label>
                <select name="payment_method" class="w-full p-3 border rounded-xl mb-5">
                    <option value="TRANSFER">Transfer</option>
                    <option value="COD">COD</option>
                </select>
                <div id="proof" class="mb-5">
                    <label class="block mb-2">Upload Bukti Transfer</label>
                    <input type="file" name="payment_proof" class="w-full border p-2 rounded-xl">
                </div>
                <button type="submit" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800">
                    Proses 
                </button>
            </form>
        </div>

    </div>

    <script>
        const proof = document.getElementById('proof');
        proof.style.display = 'none';
        document.querySelector('[name=payment_method]').addEventListener('change', e => {
            proof.style.display =
                e.target.value === 'TRANSFER' ? 'block' : 'none';
        });
    </script>
    {{-- <x-app-layout title="Checkout">

    </x-app-layout> --}}
@endsection
