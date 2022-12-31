import sys
import json

from gensim.models import word2vec
import tensorflow as tf
from keras.preprocessing.text import Tokenizer
from keras_preprocessing.sequence import pad_sequences
from numpy import array
import gensim
from gensim.models import KeyedVectors
import pandas as pd
import numpy as np
import gensim
import re
import spacy
from scipy.spatial.distance import cosine
import gensim
import re
import spacy

# Clean/Normalize Arabic Text
def clean_str(text):
    search = ["أ","إ","آ","ة","_","-","/",".","،"," و "," يا ",'"',"ـ","'","ى","\\",'\n', '\t','"','?','؟','!']
    replace = ["ا","ا","ا","ه"," "," ","","",""," و"," يا","","","","ي","",' ', ' ',' ',' ? ',' ؟ ',' ! ']
    
    #remove tashkeel
    p_tashkeel = re.compile(r'[\u0617-\u061A\u064B-\u0652]')
    text = re.sub(p_tashkeel,"", text)
    
    #remove longation
    p_longation = re.compile(r'(.)\1+')
    subst = r"\1\1"
    text = re.sub(p_longation, subst, text)
    
    text = text.replace('وو', 'و')
    text = text.replace('يي', 'ي')
    text = text.replace('اا', 'ا')
    
    for i in range(0, len(search)):
        text = text.replace(search[i], replace[i])
    
    #trim    
    text = text.strip()

    return text
df = pd.read_csv('./app/python/data/class.csv')
Qu = pd.read_excel('./app/python/data/Question.xlsx')
trylist = list(df['المقرر'].unique())
def split_digits_and_words(s):
    result = []
    X = 0
    for c in s:
        if c.isdigit():
            if X ==1 :
                X = 0 
                result.append(" ")
            result.append(int(c))
        else:
            result.append(c)
            X = 1 
            
    s = ''.join(str(x) for x in result)

    return s

for i in range(len(trylist)):
    
    trylist[i] = split_digits_and_words(trylist[i])
count = 0
quList = []
for i in Qu['سوال']:
    for j in trylist:
        a = i + " " + j
        quList.append(a)
        # print(a)
        count+=1
from scipy.spatial.distance import cosine
import nltk

#Load AraVec

model = gensim.models.Word2Vec.load('./app/python/data/aravec/wikipedia_cbow_100')
#import Dataset that have synonyms Question about the same thing 
# A = pd.read_excel('./data/Question.xlsx')
#converting the Dataframe into list 
# docs = 
# this Example of Question came from the user it also should include the name of class but this is how it should looks after cleaning 





###########################################################


# this is the input from the user 

target = "متى هو الموعد  المخصص لاختبار ماده math 115" 
#spliting the sentence into words

#############################################################
max = 0
max1 = []
for j in range(len(quList)):
    sen1 = quList[j].split() #taking only the first Question in the list 'اين قاعة'
    sen2 = target.split()
    wordVec1 = 0
    for i in range(len(sen1)):
        #cleaning the word
        try:
            word = clean_str(sen1[i])
        # adding the vectors of all words
            wordVec1 += model.wv[ word]
        except:
            continue
        
    wordVec2 = 0
    for i in range(len(sen2)):
        try:
            word = clean_str(sen2[i])
            wordVec2 += model.wv[ word]
        except:
            continue
    #finding the cosine similarity of the two sentences 
    similarity = 1 - cosine(wordVec1, wordVec2)
    if similarity > max :
        max = similarity
        max1 = sen1
    # print(similarity)



## change these two output into json output
##################################################
print( max1)
print( max)

##################################################



#x=sys.argv[1] # this is a system variable where a JSON will be passed from Laravel
# y has sample JSON code that is tested and carries out to laravel if called from there

y='''
{
"TestArray":[
    {
    "arg1": "test arg1",
    "arg2": "test arg2"
    },
    {
    "arg1": "test arg1",
    "arg2": "test arg2"
    }
]
}
'''


# data=json.loads(y) # loads method will take in a JSON code and decode it to be loaded in data python variable ..
                    # data can be many types of variables depending on the passed JSON

# print(json.dumps(data))

data=json.loads(y) # loads method will take in a JSON code and decode it to be loaded in data python variable ..
                    # data can be many types of variables depending on the passed JSON

print(json.dumps(data))


