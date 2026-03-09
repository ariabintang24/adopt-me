<section class="bg-gray-50 py-20">
    <div class="max-w-3xl mx-auto px-6 text-center">

        <h2 class="text-3xl font-bold mb-4">
            Contact Us
        </h2>

        <p class="text-gray-600 mb-10">
            Have questions? Send us a message.
        </p>

        <form action="{{ route('contact.send') }}" method="POST" class="space-y-6 text-left">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-2">Name</label>
                <input type="text" name="name"
                    class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-indigo-500" placeholder="Your name"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Email</label>
                <input type="email" name="email"
                    class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-indigo-500" placeholder="Your email"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Message</label>
                <textarea name="message" rows="5" class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-indigo-500"
                    placeholder="Write your message..." required></textarea>
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700 transition">
                Send Message →
            </button>

        </form>

    </div>
</section>
