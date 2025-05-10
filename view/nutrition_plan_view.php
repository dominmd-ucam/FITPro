<html>
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Lexend%3Awght%40400%3B500%3B700%3B900&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900"
    />

    <title>Plan de Nutricion</title>
    <link rel="icon" type="image/x-icon" href="data:image/x-icon;base64," />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  </head>
  <body>
    <div class="relative flex size-full min-h-screen flex-col bg-[#111418] dark group/design-root overflow-x-hidden" style='font-family: Lexend, "Noto Sans", sans-serif;'>
      <div class="layout-container flex h-full grow flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#293038] px-10 py-3">
          <div class="flex items-center gap-4 text-white">
            <div class="size-4">
              <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 4H42V17.3333V30.6667H24V44H6V30.6667V17.3333H24V4Z" fill="currentColor"></path>
              </svg>
            </div>
            <h2 class="text-white text-lg font-bold leading-tight tracking-[-0.015em]">FITPro</h2>
          </div>
          <div class="flex flex-1 justify-end gap-8">
            <div class="flex items-center gap-9">
              <a class="text-white text-sm font-medium leading-normal" href="index.php">Dashboard</a>
              <a class="text-white text-sm font-medium leading-normal" href="#">Members</a>
              <a class="text-white text-sm font-medium leading-normal" href="#">Workouts</a>
              <a class="text-white text-sm font-medium leading-normal" href="#">Nutrition</a>
              <a class="text-white text-sm font-medium leading-normal" href="#">Community</a>
              <a class="text-white text-sm font-medium leading-normal" href="#">Reports</a>
            </div>
            <div class="flex gap-2">
              <button
                class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 bg-[#293038] text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5"
              >
                <div class="text-white" data-icon="MagnifyingGlass" data-size="20px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"
                    ></path>
                  </svg>
                </div>
              </button>
              <button
                class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 bg-[#293038] text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5"
              >
                <div class="text-white" data-icon="ChatCircleDots" data-size="20px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"
                    ></path>
                  </svg>
                </div>
              </button>
              <button
                class="flex max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-10 bg-[#293038] text-white gap-2 text-sm font-bold leading-normal tracking-[0.015em] min-w-0 px-2.5"
              >
                <div class="text-white" data-icon="Bell" data-size="20px" data-weight="regular">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                    <path
                      d="M221.8,175.94C216.25,166.38,208,139.33,208,104a80,80,0,1,0-160,0c0,35.34-8.26,62.38-13.81,71.94A16,16,0,0,0,48,200H88.81a40,40,0,0,0,78.38,0H208a16,16,0,0,0,13.8-24.06ZM128,216a24,24,0,0,1-22.62-16h45.24A24,24,0,0,1,128,216ZM48,184c7.7-13.24,16-43.92,16-80a64,64,0,1,1,128,0c0,36.05,8.28,66.73,16,80Z"
                    ></path>
                  </svg>
                </div>
              </button>
            </div>
            <div
              class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
              style='background-image: url("https://cdn.usegalileo.ai/sdxl10/5ee9e619-ec66-4791-99b0-fe51f07eb54e.png");'
            ></div>
          </div>
        </header>
        <div class="px-40 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="flex flex-wrap justify-between gap-3 p-4">
              <p class="text-white tracking-light text-[32px] font-bold leading-tight min-w-72">Weekly Meal Plan</p>
              <button
                class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-8 px-4 bg-[#293038] text-white text-sm font-medium leading-normal"
              >
                <span class="truncate">Generate a new plan</span>
              </button>
            </div>
            <h3 class="text-white text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Monday</h3>
            <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
              <div class="flex flex-col gap-3 pb-3">
                <div
                  class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                  style='background-image: url("https://cdn.usegalileo.ai/sdxl10/7cb13b2f-c9b2-497b-b7d8-75f3103ec362.png");'
                ></div>
                <p class="text-white text-base font-medium leading-normal">Breakfast</p>
              </div>
              <div class="flex flex-col gap-3 pb-3">
                <div
                  class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                  style='background-image: url("https://cdn.usegalileo.ai/sdxl10/4a67866b-2af5-4f66-a7a0-ef875c3b9dc7.png");'
                ></div>
                <p class="text-white text-base font-medium leading-normal">Lunch</p>
              </div>
              <div class="flex flex-col gap-3 pb-3">
                <div
                  class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                  style='background-image: url("https://cdn.usegalileo.ai/sdxl10/b527259b-592b-45f8-bb06-322afb507a8d.png");'
                ></div>
                <p class="text-white text-base font-medium leading-normal">Dinner</p>
              </div>
              <div class="flex flex-col gap-3 pb-3">
                <div
                  class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                  style='background-image: url("https://cdn.usegalileo.ai/sdxl10/51938008-14e3-424c-bd68-5e5846546076.png");'
                ></div>
                <p class="text-white text-base font-medium leading-normal">Snack</p>
              </div>
            </div>
            <div class="flex flex-col gap-3 p-4">
              <div class="flex gap-6 justify-between"><p class="text-white text-base font-medium leading-normal">Breakfast</p></div>
              <div class="rounded bg-[#3c4753]"><div class="h-2 rounded bg-white" style="width: 80%;"></div></div>
              <p class="text-[#9daab8] text-sm font-normal leading-normal">300/400 calories</p>
            </div>
            <div class="flex flex-col gap-3 p-4">
              <div class="flex gap-6 justify-between"><p class="text-white text-base font-medium leading-normal">Lunch</p></div>
              <div class="rounded bg-[#3c4753]"><div class="h-2 rounded bg-white" style="width: 50%;"></div></div>
              <p class="text-[#9daab8] text-sm font-normal leading-normal">500/1000 calories</p>
            </div>
            <div class="flex flex-col gap-3 p-4">
              <div class="flex gap-6 justify-between"><p class="text-white text-base font-medium leading-normal">Dinner</p></div>
              <div class="rounded bg-[#3c4753]"><div class="h-2 rounded bg-white" style="width: 20%;"></div></div>
              <p class="text-[#9daab8] text-sm font-normal leading-normal">200/1000 calories</p>
            </div>
            <div class="flex flex-col gap-3 p-4">
              <div class="flex gap-6 justify-between"><p class="text-white text-base font-medium leading-normal">Snack</p></div>
              <div class="rounded bg-[#3c4753]"><div class="h-2 rounded bg-white" style="width: 70%;"></div></div>
              <p class="text-[#9daab8] text-sm font-normal leading-normal">350/500 calories</p>
            </div>
            <h3 class="text-white text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Tuesday</h3>
            <div class="grid grid-cols-[repeat(auto-fit,minmax(158px,1fr))] gap-3 p-4">
              <div class="flex flex-col gap-3 pb-3">
                <div
                  class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                  style='background-image: url("https://cdn.usegalileo.ai/sdxl10/19a51f16-e27b-4282-b012-a370ace93525.png");'
                ></div>
                <p class="text-white text-base font-medium leading-normal">Breakfast</p>
              </div>
              <div class="flex flex-col gap-3 pb-3">
                <div
                  class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                  style='background-image: url("https://cdn.usegalileo.ai/sdxl10/a6a20c33-78c8-419b-acb6-e403efc74e96.png");'
                ></div>
                <p class="text-white text-base font-medium leading-normal">Lunch</p>
              </div>
              <div class="flex flex-col gap-3 pb-3">
                <div
                  class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                  style='background-image: url("https://cdn.usegalileo.ai/sdxl10/f4aca105-26bb-409c-967c-d14ca5aa795b.png");'
                ></div>
                <p class="text-white text-base font-medium leading-normal">Dinner</p>
              </div>
              <div class="flex flex-col gap-3 pb-3">
                <div
                  class="w-full bg-center bg-no-repeat aspect-square bg-cover rounded-xl"
                  style='background-image: url("https://cdn.usegalileo.ai/sdxl10/1eab7991-eb30-4492-a88e-c82fa64de1fe.png");'
                ></div>
                <p class="text-white text-base font-medium leading-normal">Snack</p>
              </div>
            </div>
            <div class="flex flex-col gap-3 p-4">
              <div class="flex gap-6 justify-between"><p class="text-white text-base font-medium leading-normal">Breakfast</p></div>
              <div class="rounded bg-[#3c4753]"><div class="h-2 rounded bg-white" style="width: 100%;"></div></div>
              <p class="text-[#9daab8] text-sm font-normal leading-normal">400/400 calories</p>
            </div>
            <div class="flex flex-col gap-3 p-4">
              <div class="flex gap-6 justify-between"><p class="text-white text-base font-medium leading-normal">Lunch</p></div>
              <div class="rounded bg-[#3c4753]"><div class="h-2 rounded bg-white" style="width: 80%;"></div></div>
              <p class="text-[#9daab8] text-sm font-normal leading-normal">800/1000 calories</p>
            </div>
            <div class="flex flex-col gap-3 p-4">
              <div class="flex gap-6 justify-between"><p class="text-white text-base font-medium leading-normal">Dinner</p></div>
              <div class="rounded bg-[#3c4753]"><div class="h-2 rounded bg-white" style="width: 50%;"></div></div>
              <p class="text-[#9daab8] text-sm font-normal leading-normal">500/1000 calories</p>
            </div>
            <div class="flex flex-col gap-3 p-4">
              <div class="flex gap-6 justify-between"><p class="text-white text-base font-medium leading-normal">Snack</p></div>
              <div class="rounded bg-[#3c4753]"><div class="h-2 rounded bg-white" style="width: 90%;"></div></div>
              <p class="text-[#9daab8] text-sm font-normal leading-normal">450/500 calories</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
