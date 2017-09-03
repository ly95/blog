#!/usr/bin/env python
# -*- coding=utf-8 -*-

import os

os.chdir('./_posts')

tags = []

for x in os.listdir('.'):
    if not x.endswith(".md"):
        continue

    with open(x, 'r') as fp:
        for line in fp.readlines():
            if 'tags:' in line:
                for x in line.split(':')[1].split(' '):
                    tag = x.strip()
                    if not tag or tag in tags:
                        continue
                    tags.append(tag)
                    break

os.chdir('../_my_tags/')

for tag in tags:
    with open(tag.lower() + '.md', 'w') as fp:
        fp.write("---\n" + "slug: " + tag + "\n" + "name: " + tag + "\n---")