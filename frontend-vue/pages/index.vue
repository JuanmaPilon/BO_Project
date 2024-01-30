<template>
  <div>
    <header>
      <div>
        <h1 class="font-extrabold text-5xl text-center">Welcome!</h1>
      </div>
    </header>

    <main class="container mx-auto my-8 flex items-center justify-content">
      <div class="w-full max-w-md">
        <form action="#">
          <div class="mb-4">
            <label for="#" class="inputText">User</label>
            <input type="text" id="username" name="username" class="inputBox" placeholder="john@doe.com"/>
          </div>
          <div>
            <label for="#" class="inputText">Password</label>
            <input type="text" id="password" name="password" class="inputBox" placeholder="**********"/>
          </div>
          <button type="submit" class="btn">Login</button>
        </form>
      </div>
    </main>
  </div>
</template>

<script>
export default {};
</script>

<style></style>
