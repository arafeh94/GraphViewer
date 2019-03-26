function showp(input,dir)
opengl('save', 'software')
addpath('jsonlab')
x = loadjson(input);
bar(x);
saveas(gcf,strcat(dir,'Barchart2.png'));
disp(strcat(dir,'Barchart2.png'))

