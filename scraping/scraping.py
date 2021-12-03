import re
import wget

fout = open("result.txt", "a")

for line in open("index.html", "r"):
    hrefs = re.findall("href=\"[a-z0-9._:/].*\"", line)
    if len(hrefs) > 0:
        for finding in hrefs:
            fout.write(finding[6:-1] + "\n")

fout.close()

for line in open("result.txt", "r"):
    wget.download(line)
