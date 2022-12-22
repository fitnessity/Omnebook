


if ARGV.any?
  ARGV.each do |name|
    if File.exists?("./test_#{name}.rb")
      require_relative 'test_' + name
    end
  end
else
  Dir["./test_*.rb"].each do |name|
    require_relative name
  end  
end

