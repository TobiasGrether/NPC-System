pipeline {
  agent any
  environment {
    REPO_NAME = getRepoName()
  }
    stages {
    stage('Server Preparation'){
        steps {
            sh 'mkdir ./build'
            sh 'cp -R `ls | egrep -v "^build$"` build/.'
        }
    }
    stage('Download') {
      steps {
        echo 'Building...'
        sh 'wget http://betacp.battlemc.de/build.txt'
        sh 'mv build.txt BuildScript.php'
        sh 'chmod +x BuildScript.php'
      }
    }

    stage('Building') {
      steps {
        echo 'Building Plugin..'
        sh "${PHP}/php -dphar.readonly=0 BuildScript.php --make build --out ${env.REPO_NAME}.phar"
        echo 'Build completed!'
      }
    }

    stage('Upload') {
      steps {
        archiveArtifacts(artifacts: "${env.REPO_NAME}.phar", onlyIfSuccessful: true)
      }
    }

  }
	post {
             always {
                 deleteDir()
             }
         }
 
}
 def getRepoName() {
    return scm.getUserRemoteConfigs()[0].getUrl().tokenize('/').last().split("\\.")[0]
  }