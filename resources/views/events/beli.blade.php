@extends('layouts.app')

@section('content')
<div id="app" class="form-container">
    <div class="form-box">
        <h2 class="text-center">Buy Ticket for {{ $event->name }}</h2>

        <form method="POST" :action="purchaseUrl">
            @csrf
            <!-- Input Nama -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" v-model="name" id="name" class="form-control" placeholder="Masukan Nama" required>
            </div>

            <!-- Input Nomor WhatsApp -->
            <div class="form-group">
                <label for="whatsapp">WhatsApp Number:</label>
                <input type="text" v-model="whatsapp" id="whatsapp" class="form-control" placeholder="Masukan Nomor Whatsapp" required>
            </div>

            <!-- Dropdown Jenis Tiket -->
            <div class="form-group">
                <label for="ticket-type">Ticket Type:</label>
                <select v-model="ticketType" id="ticket-type" class="form-control" required>
                    <option value="reguler">Regular</option>
                    <option value="vip">VIP</option>
                </select>
            </div>

            <!-- Metode Pembayaran -->
            <div class="form-group">
                <label for="payment-method">Payment Method:</label>
                <select v-model="paymentMethod" id="payment-method" class="form-control" required>
                    <option value="gpay">GoPay</option>
                    <option value="QRIS">QRIS</option>
                    <option value=""></option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-block">Purchase Ticket</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            name: '',
            whatsapp: '',
            ticketType: 'reguler',
            paymentMethod: 'gpay'
        },
        computed: {
            purchaseUrl() {
                return `{{ route('tickets.purchase', $event->id) }}`
            }
        }
    });
</script>
@endpush

@push('styles')
<style>
    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f7f9fc;
        margin-top: 100px;
    }
    .form-box {
        background-color: white;
        padding: 30px;
        border-radius: 100px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        width: 400px;
    }
    .form-box h2 {
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: bold;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    .btn-block {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
    }
    .btn-block:hover {
        background-color: #0056b3;
    }
</style>
@endpush
