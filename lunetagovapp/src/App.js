import React, { useEffect } from 'react';
import {SafeAreaView } from 'react-native';
import { WebView } from 'react-native-webview';

export default function App(){

    return (
        <SafeAreaView style={{flex: 1}}>
            <WebView 
                source={{ uri: 'https://lunetagov.com.br/site/' }} 
                overScrollMode="content"
                scrollEnabled={false}
                useWebKit={true}
                originWhitelist={['*']}
                javaScriptEnabled={true}
                cacheEnabled={true}
                allowFileAccess={true}
                domStorageEnabled={true}
            />
        </SafeAreaView>
    )
}