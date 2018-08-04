<template>
  <el-form :model="user"
           :rules="rules"
           ref="signup"
           label-width="100px"
           class="signup">

    <el-form-item>
      <h1>注册</h1>
    </el-form-item>
    <el-form-item label="头像"
                  prop="avator">

      <el-upload class="upload-demo"
                 action="https://jsonplaceholder.typicode.com/posts/"
                 :file-list="fileList"
                 list-type="picture">
        <el-button size="small"
                   type="primary">点击上传</el-button>
        <div slot="tip"
             class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
      </el-upload>
    </el-form-item>
    <el-form-item label="用户名"
                  prop="name">
      <el-input v-model="user.name"></el-input>
    </el-form-item>
    <el-form-item label="邮箱"
                  prop="email">
      <el-input v-model="user.email"></el-input>
    </el-form-item>
    <el-form-item label="密码"
                  auto-complete="off"
                  prop="pwd">
      <el-input v-model="user.pwd"
                type="password"></el-input>
    </el-form-item>

    <el-form-item>
      <el-button type="primary"
                 @click="submitForm('signup')">注册</el-button>
      <router-link to="/">登录</router-link>
    </el-form-item>
  </el-form>
</template>
<script>
import { mapActions } from 'vuex'

export default {
  data () {
    return {
      user: {
        name: '',
        pwd: '',
        email: '',
        avator: ''
      },
      fileList: [],
      rules: {
        name: [
          { required: true, message: '请输入活动名称', trigger: 'blur' },
          { min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'blur' }
        ],
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
      'signup'
    ]),

    submitForm (formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          console.log(this.user)
          this.signup(this.user).then(() => {
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
.signup {
  width: 100%;
  box-sizing: border-box;
  padding: 20px;
}

input[type='file'] {
  padding: 7px;
  padding-left: 0;
  line-height: 1;
}
</style>
