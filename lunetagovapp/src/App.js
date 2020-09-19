import React, { useEffect } from 'react';
import {SafeAreaView, Linking, Dimensions } from 'react-native';
import { WebView } from 'react-native-webview';
import {check, PERMISSIONS, request} from 'react-native-permissions'

export default function App(){
    useEffect(()=>{
        console.log("alo")
        request(PERMISSIONS.ANDROID.WRITE_EXTERNAL_STORAGE).then((result) => {
            console.log(result)
          });
    }, [])

    function handleUrlWithZip(result){
        console.log(result)
    }
    return (
        <SafeAreaView style={{flex: 1}}>
            <WebView 
                source={{ uri: 'http://192.168.25.4:80/lunetagov/site/consultas.php' }} 
                overScrollMode="content"
                scrollEnabled={false}
                useWebKit={true}
                originWhitelist={['*']}
                javaScriptEnabled={true}
                cacheEnabled={true}
                allowFileAccess={true}
                domStorageEnabled={true}
                startInLoadingState={true}
                allowUniversalAccessFromFileURLs={true}
                allowFileAccessFromFileURLs={true}
                mixedContentMode={'always'}
                allowsLinkPreview={true}
                onFileDownload={({ nativeEvent: { downloadUrl } }) => {
                    console.log("alo", downloadUrl)
                  }}
                allowingReadAccessToURL={true}
            />
          
            
        </SafeAreaView>
    )
}