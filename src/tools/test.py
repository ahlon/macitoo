import urllib2
url='http://www.baidu.com/s?wd=cloga'
content=urllib2.urlopen(url).read()

import re
urls_pat=re.compile(r'<span class="g">(.*?)</span>')
siteUrls=re.findall(results_pat,content)

from BeautifulSoup import BeautifulSoup
soup=BeautifulSoup(content)
siteUrls=soup.findAll('span',attrs={'class':'g'})

strip_tag_pat=re.compile(r'<.*?>')
file=open('results000.csv','w')
for i in results:
    i0=re.sub(strip_tag_pat,'',i)
    i0=i0.strip()
    i1=i0.split(' ')
    date=i1[-1]
    siteUrl=''.join(i1[:-1])
    rank+=1
    file.write(date+','+siteUrl+','+str(rank)+'\n')
file.close()