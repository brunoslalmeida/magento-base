def imageName = 'brunoslalmeida/magento_base'

pipeline {
  agent {
    kubernetes {
      label 'jenkins-pod'
    }
  }
  stages {
    stage('Build Docker Image') {
      steps {
        script {
          sh "docker build --network host -t ${imageName}:latest ."
        }
      }
    }

    stage('Creating Release and Tagging') {
      when {
        anyOf {
          branch 'develop'
          branch 'master'
        }
      }
      steps {
        withCredentials([string(credentialsId: 'github-cabrindes-semantic', variable: 'TOKEN')]) {
          sh 'npm install'
          sh "GH_TOKEN=${TOKEN} node_modules/semantic-release/bin/semantic-release.js"
        }
      }
    }

      stage('Tag & Publish Docker Image') {
      steps {
        script {
          def tag = sh(returnStdout: true, script: 'git tag --sort version:refname | tail -1 | cut -c2-6').trim()
          def tagA = sh(returnStdout: true, script: 'git tag --sort version:refname | tail -1 | cut -c2-4').trim()
          def tagB = sh(returnStdout: true, script: 'git tag --sort version:refname | tail -1 | cut -c2-2').trim()

          sh "docker tag ${imageName}:latest ${imageName}:${tag}"
          sh "docker tag ${imageName}:latest ${imageName}:${tagA}"
          sh "docker tag ${imageName}:latest ${imageName}:${tagB}"

          withCredentials([usernamePassword(credentialsId: 'dockerhub', usernameVariable: 'USERNAME', passwordVariable: 'PASSWORD')]){
            sh "docker login -p ${PASSWORD}  -u ${USERNAME} "
          }

          sh "docker push ${imageName}"
        }
      }
    }
  }
}
