---
layout: post
title: ScollView保持滑动到底部
date: 2020-12-17
categories: 笔记
tags: IOS
---

没有什么好说的，直接看代码片段。

```swift
import SwiftUI

struct Message: Identifiable, Equatable {
    let id: Int
    let content: String
}

struct ContentView: View {
    @State private var messages: [Message] = [Message(id: 1, content: "hi")]
    var body: some View {
        ScrollView {
            Button("Add message") { 
                messages.append(Message(id: messages.last!.id + 1, content: "hi"))
            }.padding(.bottom)
            
            ScrollViewReader { reader in
                ForEach(messages) { item in
                    Text(item.content)
                        .id(item.id)
                }
                EmptyView()
                    .onChange(of: messages) { newValue in
                        reader.scrollTo(messages.last?.id, anchor: .bottom)
                    }
            }
        }
    }
}
```