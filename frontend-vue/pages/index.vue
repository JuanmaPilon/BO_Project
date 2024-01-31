<template>
  <div>
    <main class="container mx-auto flex items-center justify-center -my-10">
      <h1 class="font-extrabold text-5xl text-center mb-12">Welcome!</h1>
      <div class="w-full max-w-md">
        <form action="#">
          <div class="mb-4">
            <label for="#" class="inputText">Add</label>
            <input type="text" id="username" name="username" class="inputBox" placeholder="john@doe.com"/>
          </div>
          <div>
            <label for="#" class="inputText">Password</label>
            <input type="text" id="password" name="password" class="inputBox" placeholder="**********"/>
          </div>
          <button type="submit" class="btn">LOGIN</button>
        </form>
      </div>
    </main>
  </div>
</template>

<script>
export default {};
</script>

<style></style>
