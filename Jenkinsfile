def imageName = "brunoslalmeida/magento_base"

pipeline {
  agent {
    kubernetes {
      label 'jenkins-pod'
    }
  }
  stages {
    stage('Creating Release and Tagging') {
      when { 
        anyOf { 
          branch 'develop'; 
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
    stage('Build & Publish Docker Image') {
      steps {
        script {
          def TAG = sh(returnStdout: true, script: "git tag --sort version:refname | tail -1 | cut -c2-6").trim()
          def TAGA = sh(returnStdout: true, script: "git tag --sort version:refname | tail -1 | cut -c2-4").trim()
          def TAGB = sh(returnStdout: true, script: "git tag --sort version:refname | tail -1 | cut -c2-2").trim()


          sh "docker build --network host -t ${imageName}:${TAG} -t ${imageName}:${TAGA} -t ${imageName}:${TAGB} -t ${imageName}:latest ."
          withCredentials([usernamePassword(credentialsId: 'dockerhub', usernameVariable: 'USERNAME', passwordVariable: 'PASSWORD')]) {
            sh "docker login -p ${PASSWORD}  -u ${USERNAME} "
          }
          sh "docker push ${imageName}"
        }
      }
    }
  }
}