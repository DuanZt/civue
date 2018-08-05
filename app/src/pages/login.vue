<template>

  <el-form :model="user"
           :rules="rules"
           ref="login"
           label-width="100px"
           class="login">
    <el-form-item>
      <h1>登录</h1>
    </el-form-item>
    <el-form-item label="邮箱"
                  prop="email">
      <el-input v-model="user.email"></el-input>
    </el-form-item>
    <el-form-item label="密码"
                  prop="pwd">
      <el-input v-model="user.pwd"
                type="password"
                auto-complete="off"></el-input>
    </el-form-item>
    <el-form-item>
      <el-button type="primary"
                 @click="submitForm('login')">登录</el-button>
      <router-link to="/signup">注册</router-link>
    </el-form-item>
  </el-form>
</template>
<script>
import { mapActions } from 'vuex'

export default {
  data () {
    return {
      user: {
        email: '',
        pwd: ''
      },
      rules: {
        email: [
          { required: true, message: '请输入邮箱', trigger: 'blur' },
          { type: 'email', message: '请输入正确的邮箱', trigger: 'blur' }
        ],
        pwd: [
          { required: true, message: '请输入密码', trigger: 'blur' },
          { min: 8, max: 32, message: '长度在 8 到 32 个字符', trigger: 'blur' }
        ]
      }
    }
  },
  methods: {
    ...mapActions([
      'login'
    ]),

    submitForm (formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          this.login(this.user).then(() => {
            this.$router.push('/home')
          })
        } else {
          console.log('error submit!!')
          return false
        }
      })
    }
  }
}
</script>

<style lang="scss" >
.login {
  width: 100%;
  box-sizing: border-box;
  padding: 20px;
}
</style>
