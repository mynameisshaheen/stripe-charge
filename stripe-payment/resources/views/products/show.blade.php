@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->description }}</p>
        <h4>Price: ${{ $product->price }}</h4>

        <form id="payment-form">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" class="form-control" required>
            </div>

            <div id="card-element" class="mt-3"></div>

            <button type="submit" id="pay-button" class="btn btn-success mt-3">Pay Now</button>
        </form>

        <div id="payment-message"></div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        let clientSecret;

        async function createPaymentIntent() {
            const response = await fetch("{{ route('product.charge', $product->id) }}", {
                method: "POST",
                headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" }
            });
            const data = await response.json();
            clientSecret = data.clientSecret;
            console.log(clientSecret);
        }

        createPaymentIntent();

        const elements = stripe.elements();
        const cardElement = elements.create("card");
        cardElement.mount("#card-element");

        document.getElementById("payment-form").addEventListener("submit", async (event) => {
            event.preventDefault();

            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;

            const { paymentIntent, error } = await stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: name,
                        email: email
                    }
                }
            });

            if (error) {
                document.getElementById("payment-message").innerText = error.message;
            } else {
                document.getElementById("payment-message").innerText = "Payment successful!";
            }
        });
    </script>
@endsection
