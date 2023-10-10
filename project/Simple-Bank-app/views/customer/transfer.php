<?php
      include __DIR__ .'/../Layout/Header.php';
  ?>

  <body class="h-full">
    <div class="min-h-full">

      <?php
          include __DIR__ .'/../Layout/Navber.php';
      ?>
      <main class="-mt-32">
        <div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
          <div class="bg-white rounded-lg p-2">
            <!-- Current Balance Stat -->
            <dl
              class="mx-auto grid grid-cols-1 gap-px sm:grid-cols-2 lg:grid-cols-4">
              <div
                class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
                <dt class="text-sm font-medium leading-6 text-gray-500">
                  Current Balance
                </dt>
                <dd
                  class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">
                  ৳ <?php echo $amount; ?>
                </dd>
              </div>
            </dl>

            <hr />
            <!-- Transfer Form -->
            <div class="sm:rounded-lg">
              <div class="px-4 py-5 sm:p-6">
                <div class="mt-4 text-sm text-gray-500">
                  <form action="/customer/transaction"method="POST">
                    <input type="hidden" name="type" value="3"/>
                    <!-- Recipient's Email Input -->
                    <select required name="recipient_id" class="block w-full ring-0 outline-none py-2 text-gray-800 border-b placeholder:text-gray-400 md:text-4xl" >
                        <option value="" >--select--</option>
                        <?php foreach ($users as $item): ?>
                          <option value="<?php echo $item['email'] ?>" ><?php echo $item['email'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <!-- Amount -->
                    <div class="relative mt-4 md:mt-8">
                      <div
                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-0">
                        <span class="text-gray-400 md:text-4xl">$</span>
                      </div>
                     
                      <input type="number"name="amount"id="amount"class="block w-full ring-0 outline-none pl-4 py-2 md:pl-8 text-gray-800 border-b border-b-emerald-500 placeholder:text-gray-400 md:text-4xl"placeholder="0.00" required />
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-5">
                      <button
                        type="submit"
                        class="w-full px-6 py-3.5 text-base font-medium text-white bg-emerald-600 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 rounded-lg md:text-xl text-center">
                        Proceed
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
